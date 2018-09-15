$(document).ready(function() {

    $('#categories').select2({
        placeholder: 'Choose category...'
    });

    $('#tags').select2({
        placeholder: 'Choose tags...',
        tags: true
    });
});
