
const dropArea = document.querySelector('.drop-section')
const listSection = document.querySelector('.list-section')
const listContainer = document.querySelector('.list')
const fileSelector = document.querySelector('.file-selector')
const fileSelectorInput = document.querySelector('.file-selector-input')
const mainId = document.getElementById('mainId').value;
const tableName = document.getElementById('tableName').value;
 // Create a CSRF token meta tag to retrieve the token value
 var csrfToken = $('meta[name="csrf-token"]').attr('content');



// upload files with browse button
fileSelector.onclick = () => fileSelectorInput.click()
fileSelectorInput.onchange = () => {
    [...fileSelectorInput.files].forEach((file) => {
        if (typeValidation(file.type)) {
            uploadFile(file)
        }
    })
}


// when file is over the drag area
dropArea.ondragover = (e) => {
    e.preventDefault();
    [...e.dataTransfer.items].forEach((item) => {
        if (typeValidation(item.type)) {
            dropArea.classList.add('drag-over-effect')
        }
    })
}
// when file leave the drag area
dropArea.ondragleave = () => {
    dropArea.classList.remove('drag-over-effect')
}
// when file drop on the drag area
dropArea.ondrop = (e) => {
    e.preventDefault();
    dropArea.classList.remove('drag-over-effect')
    if (e.dataTransfer.items) {
        [...e.dataTransfer.items].forEach((item) => {
            if (item.kind === 'file') {
                const file = item.getAsFile();
                if (typeValidation(file.type)) {
                    uploadFile(file)
                }
            }
        })
    } else {
        [...e.dataTransfer.files].forEach((file) => {
            if (typeValidation(file.type)) {
                uploadFile(file)
            }
        })
    }
}

// check the file type
function typeValidation(type) {
    var splitType = type.split('/')[0]
    if (splitType == 'image') {
        return true
    }
}

// upload file function
function uploadFile(file) {
    listSection.style.display = 'block';
    var li = document.createElement('li');
    li.classList.add('in-prog');
    li.innerHTML = `
<div class="col">
    <img src="/admin/icons/${iconSelector(file.type)}" alt="">
</div>
<div class="col">
    <div class="file-name">
        <div class="name">${file.name}</div>
        <span>0%</span>
    </div>
    <div class="file-progress">
        <span></span>
    </div>
    <div class="file-size">${(file.size/(1024*1024)).toFixed(2)} MB</div>
</div>
<div class="col">
    <svg xmlns="http://www.w3.org/2000/svg" class="cross" height="20" width="20"><path d="m5.979 14.917-.854-.896 4-4.021-4-4.062.854-.896 4.042 4.062 4-4.062.854.896-4 4.062 4 4.021-.854.896-4-4.063Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" class="tick" height="20" width="20"><path d="m8.229 14.438-3.896-3.917 1.438-1.438 2.458 2.459 6-6L15.667 7Z"/></svg>
</div>
`;
    listContainer.prepend(li);

    var formData = new FormData();
    formData.append('file', file);
    formData.append('id', mainId); // Assuming mainId is defined

    formData.append('_token', csrfToken);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/control/' + tableName + '/images/store', true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            li.classList.add('complete');
            li.classList.remove('in-prog');
            fetchAndDisplayImages();
        } else {
            console.error('Error uploading file:', xhr.statusText);
            // Log the response from the server to know the bugs
            console.log('Server response:', xhr.responseText);
            /*  */
            li.remove();
        }
    };
    xhr.onerror = function() {
        console.error('Error uploading file:', xhr.statusText);
        li.remove();
    };
    xhr.send(formData);

    li.querySelector('.cross').onclick = () => {
        xhr.abort(); // Abort the upload request
        console.log('Upload aborted');
    };
}

// find icon for file
function iconSelector(type) {
    var splitType = (type.split('/')[0] == 'application') ? type.split('/')[1] : type.split('/')[0];
    return splitType + '.png'
}

// AJAX request to delete an image
$(document).on('click', '.delete-sub-image-btn', function() {
    var imageId = $(this).data('id');



    // Send a DELETE request using Ajax
    $.ajax({
        url: '/control/' + tableName + '/images/' + imageId + '/delete',
        type: 'POST',
        data: {
            _method: 'DELETE' // Laravel requires _method field for non-GET requests to simulate DELETE
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken // Pass the CSRF token in the request headers
        },
        success: function(response) {
            if (response.message === 'success') {
                // Image deleted successfully
                // Reload images after deletion
                fetchAndDisplayImages();
            } else {
                // Display error message
                console.log(response);
            }
        }
    });
});


// Function to fetch and display images
$(document).ajaxStart(function() {
    $('#loadingDiv').show();
});
$(document).ajaxComplete(function() {
    $('#loadingDiv2').hide(); // Hide loading div
});

