<x-layout>
    <div class="listing-page-header">
        <div class="container">
            <h1 class="listing-page-title">Global Talent Network</h1>
            <p class="listing-page-subtitle">Discover top-tier creators across lifestyle, fashion, and beauty.</p>
        </div>
    </div>

    <x-talent-section 
        :talents="$talents" 
        :creatorsCount="$creatorsCount" 
        :campaignsCount="$campaignsCount" 
        :talentCategories="$talentCategories" 
        :talentCountries="$talentCountries" 
        :showViewAll="false" 
    />

    <style>
        .listing-page-header {
            background-color: #000000;
            padding: 120px 0 60px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .listing-page-title {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .listing-page-subtitle {
            font-size: 16px;
            color: rgba(255,255,255,0.6);
            letter-spacing: 1px;
        }

        /* Adjust background for consistency */
        .talent-section {
            background-color: #000000 !important;
        }
    </style>
</x-layout>
