window.swiftalert = function (msg, type, option) {
    option = typeof option !== 'undefined' ? option : {};
    option.closable = typeof option.closable !== 'undefined' ? option.closable : true;
    option.fontAwesome = typeof option.fontAwesome !== 'undefined' ? option.fontAwesome : true;
    option.autoClose = typeof option.autoClose !== 'undefined' ? option.autoClose : true;
    type = typeof type !== 'undefined' ? type : 'default';

    let icon = '';
    let closeButton = '';

    const config = {
        types: {
            'success': 'check',
            'danger': 'times',
            'warning': 'exclamation-triangle',
            'question': 'question-circle',
            'info': 'info-circle',
            'default': 'exclamation-circle'
        }
    };

    if (option.closable === true) {
        closeButton = '<span class="close">&times;</span>';
    }

    if (option.fontAwesome === true) {
        icon = '<i class="fas fa-fw fa-' + config.types[type] + '"></i>';
    }

    const template = '<div class="swiftalert swiftalert-' + type + '">' + icon + msg + closeButton + '</div>';

    if (this.opened === true) {
        $('.swiftalert').remove();
        this.opened = false;
    }

    this.opened = true;

    $('body').append(template);

    setTimeout(function () {
        $('.swiftalert').addClass('opened')
    }, 500);

    $('.swiftalert').find('.close').on('click', function () {
        $('.swiftalert').remove();
        swiftalert.opened = false;
    });

    if (option.autoClose) {
        setTimeout(function () {
            $('.swiftalert').removeClass('opened')
        }, 5000, function() {
            $('.swiftalert').remove();
            swiftalert.opened = false;
        });
    }
};
