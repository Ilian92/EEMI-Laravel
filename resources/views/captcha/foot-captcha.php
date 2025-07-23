<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Vérification CAPTCHA</h4>
                        <p class="mb-0 text-muted">Sélectionnez toutes les images contenant des <strong>pieds</strong>
                        </p>
                    </div>
                    <div class="card-body">
                        <!-- Grille CAPTCHA -->
                        <div id="captcha-grid" class="captcha-grid mb-3">
                            <!-- Les cases seront générées par JavaScript -->
                        </div>

                        <!-- Boutons de contrôle -->
                        <div class="d-flex justify-content-between">
                            <button type="button" id="refresh-captcha" class="btn btn-secondary">
                                <i class="fas fa-sync-alt"></i> Actualiser
                            </button>
                            <button type="button" id="validate-captcha" class="btn btn-primary">
                                Valider
                            </button>
                        </div>

                        <!-- Message de résultat -->
                        <div id="captcha-message" class="mt-3" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .captcha-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            background-color: #ddd;
            padding: 2px;
            border-radius: 4px;
            max-width: 300px;
            margin: 0 auto;
        }

        .captcha-cell {
            aspect-ratio: 1;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .captcha-cell img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .captcha-cell:hover {
            background-color: #e9ecef;
        }

        .captcha-cell.selected {
            background-color: #007bff;
            border: 2px solid #0056b3;
        }

        .captcha-cell.selected::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        .captcha-cell.selected img {
            opacity: 0.3;
        }

        .captcha-cell.fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .captcha-cell.loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .alert {
            border-radius: 6px;
        }
    </style>

    <script>
        class FootCaptcha {
            constructor() {
                this.selectedPositions = new Set();
                this.footPositions = [];
                this.init();
            }

            init() {
                this.bindEvents();
                this.generateCaptcha();
            }

            bindEvents() {
                document.getElementById('refresh-captcha').addEventListener('click', () => {
                    this.generateCaptcha();
                });

                document.getElementById('validate-captcha').addEventListener('click', () => {
                    this.validateCaptcha();
                });
            }

            async generateCaptcha() {
                this.selectedPositions.clear();
                this.showLoadingGrid();

                try {
                    const response = await fetch('/captcha/generate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    const data = await response.json();
                    this.footPositions = data.footPositions;

                    setTimeout(() => {
                        this.renderGrid();
                    }, 800); // Délai pour l'effet de loading

                } catch (error) {
                    console.error('Erreur lors de la génération du CAPTCHA:', error);
                    this.showMessage('Erreur lors du chargement du CAPTCHA', 'danger');
                }
            }

            showLoadingGrid() {
                const grid = document.getElementById('captcha-grid');
                grid.innerHTML = '';

                for (let i = 0; i < 9; i++) {
                    const cell = document.createElement('div');
                    cell.className = 'captcha-cell loading';
                    grid.appendChild(cell);
                }

                this.hideMessage();
            }

            renderGrid() {
                const grid = document.getElementById('captcha-grid');
                grid.innerHTML = '';

                for (let i = 0; i < 9; i++) {
                    const cell = document.createElement('div');
                    cell.className = 'captcha-cell fade-in';
                    cell.dataset.position = i;

                    if (this.footPositions.includes(i)) {
                        // Image de pied
                        const img = document.createElement('img');
                        img.src = this.getFootImage();
                        img.alt = 'Pied';
                        cell.appendChild(img);
                    } else {
                        // Image de distracteur
                        const img = document.createElement('img');
                        img.src = this.getDistractorImage();
                        img.alt = 'Autre';
                        cell.appendChild(img);
                    }

                    cell.addEventListener('click', () => this.toggleCell(i, cell));
                    grid.appendChild(cell);
                }
            }

            toggleCell(position, cellElement) {
                if (this.selectedPositions.has(position)) {
                    this.selectedPositions.delete(position);
                    cellElement.classList.remove('selected');
                } else {
                    this.selectedPositions.add(position);
                    cellElement.classList.add('selected');
                }
            }

            async validateCaptcha() {
                if (this.selectedPositions.size === 0) {
                    this.showMessage('Veuillez sélectionner au moins une image', 'warning');
                    return;
                }

                try {
                    const response = await fetch('/captcha/validate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            selectedPositions: Array.from(this.selectedPositions)
                        })
                    });

                    const data = await response.json();

                    if (data.valid) {
                        this.showMessage(data.message, 'success');
                        // Rediriger ou continuer le processus
                        setTimeout(() => {
                            // window.location.href = '/next-step';
                            console.log('CAPTCHA validé - redirection possible');
                        }, 2000);
                    } else {
                        this.showMessage(data.message, 'danger');
                    }

                } catch (error) {
                    console.error('Erreur lors de la validation:', error);
                    this.showMessage('Erreur lors de la validation', 'danger');
                }
            }

            showMessage(message, type) {
                const messageElement = document.getElementById('captcha-message');
                messageElement.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
                messageElement.style.display = 'block';
            }

            hideMessage() {
                const messageElement = document.getElementById('captcha-message');
                messageElement.style.display = 'none';
            }

            getFootImage() {
                // Images de pieds (vous devrez ajouter vos propres images)
                const footImages = [
                    '/images/foot1.png'
                ];
                return footImages[Math.floor(Math.random() * footImages.length)];
            }

            getDistractorImage() {
                // Images de distracteurs
                const distractorImages = [
                    '/images/hand1.jpg'
                ];
                return distractorImages[Math.floor(Math.random() * distractorImages.length)];
            }
        }

        // Initialisation quand le DOM est prêt
        document.addEventListener('DOMContentLoaded', function () {
            new FootCaptcha();
        });
    </script>
</x-layout>