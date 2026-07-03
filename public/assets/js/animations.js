document.addEventListener('DOMContentLoaded', function () {
    var prefersReducedMotion = window.matchMedia
        && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion || !window.gsap) {
        return;
    }

    var gsap = window.gsap;
    var ScrollTrigger = window.ScrollTrigger || null;

    if (ScrollTrigger) {
        gsap.registerPlugin(ScrollTrigger);
    }

    function compact(nodes) {
        return nodes.filter(Boolean);
    }

    function toArray(selector, scope) {
        return Array.prototype.slice.call((scope || document).querySelectorAll(selector));
    }

    function animateOnEnter(trigger, callback) {
        if (!ScrollTrigger || !trigger || typeof callback !== 'function') {
            return;
        }

        ScrollTrigger.create({
            trigger: trigger,
            start: 'top 78%',
            once: true,
            onEnter: callback
        });
    }

    var heroSection = document.querySelector('.hero');

    if (heroSection) {
        var heroTimeline = gsap.timeline({
            defaults: {
                duration: 0.72,
                ease: 'power2.out'
            }
        });

        var heroIntroTargets = compact([
            heroSection.querySelector('.eyebrow'),
            heroSection.querySelector('h1'),
            heroSection.querySelector('.hero-copy > p'),
            heroSection.querySelector('.hero-actions'),
            heroSection.querySelector('.hero-secondary-link')
        ]);
        var heroReassuranceItems = toArray('.hero-reassurance li', heroSection);
        var heroMedia = heroSection.querySelector('.hero-media');

        if (heroIntroTargets.length) {
            heroTimeline.from(heroIntroTargets, {
                opacity: 0,
                y: 24,
                stagger: 0.1
            });
        }

        if (heroReassuranceItems.length) {
            heroTimeline.from(heroReassuranceItems, {
                opacity: 0,
                y: 18,
                duration: 0.55,
                stagger: 0.08
            }, '-=0.28');
        }

        if (heroMedia) {
            heroTimeline.from(heroMedia, {
                opacity: 0,
                y: 28,
                duration: 0.82
            }, '-=0.42');
        }
    }

    var servicesSection = document.querySelector('.home-services-section');

    animateOnEnter(servicesSection, function () {
        var servicesHeaderTargets = compact([
            servicesSection.querySelector('h2'),
            servicesSection.querySelector('.section-intro'),
            servicesSection.querySelector('.quick-links')
        ]);
        var serviceCards = toArray('.service-card', servicesSection);

        if (servicesHeaderTargets.length) {
            gsap.from(servicesHeaderTargets, {
                opacity: 0,
                y: 22,
                duration: 0.7,
                stagger: 0.08,
                ease: 'power2.out'
            });
        }

        if (serviceCards.length) {
            gsap.from(serviceCards, {
                opacity: 0,
                y: 24,
                duration: 0.72,
                stagger: 0.1,
                ease: 'power2.out',
                delay: 0.08
            });
        }
    });

    var activitiesSection = document.querySelector('.home-activities-section');

    animateOnEnter(activitiesSection, function () {
        var activityHeaderTargets = compact([
            activitiesSection.querySelector('.home-activities-heading'),
            activitiesSection.querySelector('.home-activities-rail')
        ]);
        var activityRows = toArray('.home-activity-row', activitiesSection);
        var activityEmptyState = activitiesSection.querySelector('.home-activities-empty');
        var activityFooter = activitiesSection.querySelector('.home-activities-footer');

        if (activityHeaderTargets.length) {
            gsap.from(activityHeaderTargets, {
                opacity: 0,
                y: 22,
                duration: 0.72,
                stagger: 0.12,
                ease: 'power2.out'
            });
        }

        if (activityRows.length) {
            gsap.from(activityRows, {
                opacity: 0,
                y: 18,
                x: 10,
                duration: 0.62,
                stagger: 0.1,
                ease: 'power2.out',
                delay: 0.08
            });
        } else if (activityEmptyState) {
            gsap.from(activityEmptyState, {
                opacity: 0,
                y: 18,
                duration: 0.62,
                ease: 'power2.out',
                delay: 0.08
            });
        }

        if (activityFooter) {
            gsap.from(activityFooter, {
                opacity: 0,
                y: 18,
                duration: 0.62,
                ease: 'power2.out',
                delay: 0.16
            });
        }
    });

    var communitySection = document.querySelector('.home-community-section');

    animateOnEnter(communitySection, function () {
        var communityTextTargets = compact([
            communitySection.querySelector('.home-community-title'),
            communitySection.querySelector('.home-community-text'),
            communitySection.querySelector('.home-community-actions')
        ]);
        var communityVisualTargets = compact([
            communitySection.querySelector('.home-community-media'),
            communitySection.querySelector('.home-community-card')
        ]);

        if (communityTextTargets.length) {
            gsap.from(communityTextTargets, {
                opacity: 0,
                y: 22,
                duration: 0.72,
                stagger: 0.1,
                ease: 'power2.out'
            });
        }

        if (communityVisualTargets.length) {
            gsap.from(communityVisualTargets, {
                opacity: 0,
                y: 24,
                x: 10,
                duration: 0.76,
                stagger: 0.12,
                ease: 'power2.out',
                delay: 0.08
            });
        }
    });

    var contactStripSection = document.querySelector('.home-contact-strip');

    animateOnEnter(contactStripSection, function () {
        var contactTargets = compact([
            contactStripSection.querySelector('.home-contact-strip-content'),
            contactStripSection.querySelector('.home-contact-strip-actions')
        ]);

        if (contactTargets.length) {
            gsap.from(contactTargets, {
                opacity: 0,
                y: 22,
                duration: 0.7,
                stagger: 0.12,
                ease: 'power2.out'
            });
        }
    });

    var engagementSection = document.querySelector('.home-engagement-section');

    animateOnEnter(engagementSection, function () {
        var engagementHeadingTargets = compact([
            engagementSection.querySelector('.home-engagement-title'),
            engagementSection.querySelector('.home-engagement-text')
        ]);
        var engagementCards = toArray('.home-engagement-card', engagementSection);

        if (engagementHeadingTargets.length) {
            gsap.from(engagementHeadingTargets, {
                opacity: 0,
                y: 22,
                duration: 0.7,
                stagger: 0.1,
                ease: 'power2.out'
            });
        }

        if (engagementCards.length) {
            gsap.from(engagementCards, {
                opacity: 0,
                y: 24,
                duration: 0.74,
                stagger: 0.12,
                ease: 'power2.out',
                delay: 0.08
            });
        }
    });

    var partnersSection = document.querySelector('.home-partners-section');

    animateOnEnter(partnersSection, function () {
        var partnersHeadingTargets = compact([
            partnersSection.querySelector('.home-partners-title'),
            partnersSection.querySelector('.home-partners-text'),
            partnersSection.querySelector('.home-partners-actions')
        ]);
        var partnerCards = toArray('.home-partner-card', partnersSection);

        if (partnersHeadingTargets.length) {
            gsap.from(partnersHeadingTargets, {
                opacity: 0,
                y: 22,
                duration: 0.7,
                stagger: 0.1,
                ease: 'power2.out'
            });
        }

        if (partnerCards.length) {
            gsap.from(partnerCards, {
                opacity: 0,
                y: 22,
                duration: 0.72,
                stagger: 0.1,
                ease: 'power2.out',
                delay: 0.08
            });
        }
    });
});
