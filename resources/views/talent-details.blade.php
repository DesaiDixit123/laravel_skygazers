<x-layout>
    <div class="talent-details-page">
        <div class="container">
            <div class="gallery-grid">
                <div class="gallery-item large">
                    <img src="{{ asset('images/creator_1.png') }}" alt="Talent Large">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/creator_2.png') }}" alt="Talent 2">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/creator_3.png') }}" alt="Talent 3">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/creator_4.png') }}" alt="Talent 4">
                </div>
            </div>

            <div class="talent-info-block">
                <h1 class="talent-page-name">{{ $name ?? 'Apeksha' }}</h1>
                
                <div class="talent-stats-row">
                    <div class="stat-spec">
                        <span class="spec-label">HEIGHT:</span>
                        <span class="spec-value">5'7"</span>
                    </div>
                    <div class="stat-spec">
                        <span class="spec-label">BUST:</span>
                        <span class="spec-value">33"</span>
                    </div>
                    <div class="stat-spec">
                        <span class="spec-label">WAIST:</span>
                        <span class="spec-value">26"</span>
                    </div>
                    <div class="stat-spec">
                        <span class="spec-label">HIPS:</span>
                        <span class="spec-value">38"</span>
                    </div>
                    <div class="stat-spec">
                        <span class="spec-label">SHOE SIZE:</span>
                        <span class="spec-value">39</span>
                    </div>
                </div>

                <div class="talent-actions">
                    <a href="#" class="btn-detail-secondary">Download PDF</a>
                    <a href="#" class="btn-detail-primary">Book this Talent</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .talent-details-page {
            background-color: #ffffff;
            color: #000000;
            padding: 100px 0;
            min-height: 100vh;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-template-rows: auto auto;
            gap: 20px;
            margin-bottom: 60px;
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 4px;
        }

        .gallery-item.large {
            grid-row: span 2;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .talent-info-block {
            margin-top: 40px;
        }

        .talent-page-name {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 30px;
            text-transform: capitalize;
        }

        .talent-stats-row {
            display: flex;
            gap: 40px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .stat-spec {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .spec-label {
            font-size: 12px;
            color: #888888;
            letter-spacing: 1px;
        }

        .spec-value {
            font-size: 18px;
            font-weight: 600;
        }

        .talent-actions {
            display: flex;
            gap: 20px;
        }

        .btn-detail-primary {
            background-color: #000000;
            color: #ffffff;
            padding: 15px 40px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: opacity 0.3s ease;
        }

        .btn-detail-secondary {
            color: #000000;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border: 1px solid rgba(0,0,0,0.1);
            padding: 15px 40px;
            border-radius: 40px;
            transition: background-color 0.3s ease;
        }

        .btn-detail-primary:hover {
            opacity: 0.8;
        }

        .btn-detail-secondary:hover {
            background-color: #f9f9f9;
        }

        @media (max-width: 1024px) {
            .gallery-grid {
                grid-template-columns: 1fr;
                grid-template-rows: auto;
            }
            .gallery-item.large {
                grid-row: span 1;
            }
        }
    </style>
</x-layout>
