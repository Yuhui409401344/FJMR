$(document).ready(function () {
    hopscotch.startTour({
        id: 'my-intro',
        steps: [
            {
                target: 'first-tour',
                title: 'Logo Here',
                content: "You can find here status of user who's currently online.",
                placement: 'bottom',
                yOffset: 10,
            },
            {
                target: 'second-tour',
                title: 'Display Text',
                content: 'Click on the button and make sidebar navigation small.',
                placement: 'top',
                zindex: 9999,
            },
            {
                target: 'third-tour',
                title: 'User settings',
                content: 'You can edit you profile info here.',
                placement: 'bottom',
                zindex: 999,
            },
            {
                target: 'end-tour',
                title: 'Thank you !',
                content: 'Here you can change theme skins and other features.',
                placement: 'top',
                zindex: 999,
            },
        ],
        showPrevButton: !0,
    })
})
