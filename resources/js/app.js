import './bootstrap';

import Dropzone from 'dropzone';
Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: "Sube aqui tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function(){
        if(document.querySelector('#imagen-post').value.trim()){
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('#imagen-post').value;

            this.options.addedfile.call(this,imagenPublicada);
            this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`)

            imagenPublicada.previewElement.classList.add('dz-success','dz-complete')
        }
    }
});



dropzone.on('success', function(file,response){
    //Asignar al input hidden la respuesta que viene del servidor
    document.querySelector("#imagen-post").value = response.imagen;
})

dropzone.on('removedfile',function(){
    document.querySelector("#imagen-post").value = "";
})

