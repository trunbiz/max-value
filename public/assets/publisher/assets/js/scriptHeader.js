// Copy
$(document).ready(function() {
    $('.copy-icon').click(function() {
        console.log(2222)
        var copiedText = '';
        $('.text-copy').each(function() {
            copiedText += $(this).text() + '\n';
        });

        $('<textarea>')
            .val(copiedText)
            .appendTo('body')
            .select();

        document.execCommand('copy');
        $('textarea').remove();

        alert('Copied to clipboard!');
    });
});
