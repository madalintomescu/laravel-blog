/**
 * Handle posts featured image preview
 */

document.getElementById('image_select').addEventListener('change', function() {
    // Create the image preview
    var container = document.getElementById('image_container');
    var image = document.createElement('img');
    image.className = 'img-fluid';
    image.setAttribute('id', 'image_preview');

    var file = document.getElementById('image_select').files[0];
    var reader = new FileReader();

    reader.addEventListener("load", function () {
        image.src = reader.result;
        container.insertBefore(image, document.getElementById('image_select'));
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }

    // Check if a image is selected
    if (document.getElementById('image_select').files.length === 1) {
        document.getElementById('remove_image_button').classList.remove('display-none');
        document.getElementById('remove_image_button').classList.add('display-block');
        document.getElementById('image_select').classList.remove('display-block');
        document.getElementById('image_select').classList.add('display-none');

    // Remove the 'removed' input if a image is selected
    if (document.getElementById('removed')) {
        var elem = document.getElementById('removed');
        elem.parentNode.removeChild(elem);
    }
}

});

 document.getElementById('remove_image_button').addEventListener('click', function() {
    document.getElementById('image_preview').outerHTML = '';

    document.getElementById('remove_image_button').classList.remove('display-block');
    document.getElementById('remove_image_button').classList.add('display-none');

    document.getElementById('image_select').classList.remove('display-none');
    document.getElementById('image_select').classList.add('display-block');

    document.getElementById('image_select').value = '';

    // Create a hidden input if the image is removed
    var input = document.createElement("input");
    input.setAttribute('type', 'hidden');
    input.setAttribute('id', 'removed');
    input.setAttribute('name', 'removed');
    document.getElementById('image_container').appendChild(input);
});
