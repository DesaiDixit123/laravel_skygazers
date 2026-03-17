<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Influencer Collaborations',
                'summary' => 'End-to-end influencer collaboration management across multiple countries.',
                'description' => 'We connect brands with talented creators and influencers to produce impactful digital campaigns across India, Brazil, UK, Australia, Germany, France, Portugal, and Slovenia. Our data-driven approach ensures you reach the right audience with the right message.',
                'image' => null,
                'benefits' => ['500+ verified creators', '250+ successful collaborations', 'Multi-country execution', 'Transparent reporting']
            ],
            [
                'title' => 'Brand Shoots & Content',
                'summary' => 'Professional brand shoots and high-quality campaign content.',
                'description' => 'We organize influencer shoots, product shoots, lifestyle campaigns, and social-media-ready content aligned with brand strategy. From conceptualization to final delivery, our team handles all aspects of production.',
                'image' => null,
                'benefits' => ['Creative direction', 'Campaign-focused visuals', 'High-quality production', 'Social media optimized']
            ],
            [
                'title' => 'UGC Content Creation',
                'summary' => 'Authentic user-generated content for social media and ads.',
                'description' => 'We provide engaging UGC videos and product-based content created by real creators to increase trust, engagement, and conversion rates. Our creators know how to craft native-feeling content that performs on TikTok, Reels, and Shorts.',
                'image' => null,
                'benefits' => ['Authentic storytelling', 'High-performing ad content', 'Engagement-focused videos', 'Rapid turnaround']
            ],
            [
                'title' => 'Talent Representation',
                'summary' => 'Strategic representation and growth support for digital creators.',
                'description' => 'We manage and support creators by connecting them with brands, handling collaborations, and helping them grow their digital presence globally. We handle the business so creators can focus on creating.',
                'image' => null,
                'benefits' => ['Brand partnerships', 'Collaboration management', 'Creator growth strategy', 'Contract negotiation']
            ],
            [
                'title' => 'Social Media Strategy',
                'summary' => 'Comprehensive social media strategies to elevate your brand presence.',
                'description' => 'Our expert team develops custom social media strategies tailored to your brand\'s unique goals and target audience. We analyze market trends, competitor activity, and audience behavior to create a roadmap for sustained digital growth.',
                'image' => null,
                'benefits' => ['Platform-specific strategies', 'Content calendar planning', 'Audience growth tactics', 'Performance analytics']
            ],
            [
                'title' => 'Event Management & PR',
                'summary' => 'Unforgettable events and strategic public relations campaigns.',
                'description' => 'From intimate influencer dinners to large-scale brand launches, we design and execute events that generate buzz and leave a lasting impression. Our PR capabilities ensure your brand story reaches the right media outlets.',
                'image' => null,
                'benefits' => ['Concept development', 'Guest list curation', 'Media outreach', 'On-site coordination']
            ],
            [
                'title' => 'Digital Advertising',
                'summary' => 'Targeted paid ad campaigns to amplify your content and drive conversions.',
                'description' => 'We maximize the impact of your influencer and UGC content through strategic paid media campaigns across Meta, TikTok, and other platforms. Our data-led approach ensures efficient ad spend and measurable ROI.',
                'image' => null,
                'benefits' => ['Campaign setup & optimization', 'A/B testing', 'Retargeting strategies', 'Detailed ROI reporting']
            ]
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}
