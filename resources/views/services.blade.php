<x-layout>
    <div class="listing-page-header">
        <div class="container">
            <h1 class="listing-page-title">Professional Services</h1>
            <p class="listing-page-subtitle">Premium creative solutions for global brands and creators.</p>
        </div>
    </div>

    <x-services-section :services="$services" :showViewAll="false" />

    <style>
        .listing-page-header {
            background-color: #000000;
            padding: 120px 0 60px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .listing-page-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 8vw, 48px);
            font-weight: 700;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .listing-page-subtitle {
            font-size: 16px;
            color: rgba(255,255,255,0.6);
            letter-spacing: 1px;
        }

        /* Adjust the transparency of the services section for a full page vibe */
        .services-section {
            background-color: #000000 !important;
        }
    </style>
</x-layout>
