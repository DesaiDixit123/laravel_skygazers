<x-layout>
    <x-hero />
    
    <x-about-section />
    
    <x-services-section />
    
    <x-talent-section />
    
    <x-team-section />
    
    <x-brands-section />
    
    <x-contact-section />
    
    <x-footer />

    <style>
        /* Fade-in Animation Classes */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in.appear {
            opacity: 1;
            transform: translateY(0);
        }

        html {
            scroll-behavior: smooth;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer for scroll animations
            const faders = document.querySelectorAll('section');
            
            faders.forEach(fader => {
                fader.classList.add('fade-in');
            });

            const appearOptions = {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px"
            };

            const appearOnScroll = new IntersectionObserver(function(entries, appearOnScroll) {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add('appear');
                    appearOnScroll.unobserve(entry.target);
                });
            }, appearOptions);

            faders.forEach(fader => {
                appearOnScroll.observe(fader);
            });
        });
    </script>
</x-layout>
