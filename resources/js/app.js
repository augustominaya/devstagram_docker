import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone",{
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,
    init: function() {
           if(document.querySelector("[name='imagen']").value.trim()){
            const imagenPublicada = {}
            imagenPublicada.size = 1234
            imagenPublicada.name = document.querySelector("[name='imagen']").value
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
            imagenPublicada.previewElement.classList.add("dz-success","dz-complete");
           }     
    },

});

//para cuando termina correctamente
dropzone.on('success', function(file, response){
    //cambiamos la respuesta para que solo muestre el nombre y no el objeto
    //console.log(response);
    //asignamos el nombre de la imagen al campo oculto imagen.
    document.querySelector("[name='imagen']").value = response;
});

//resetear el valor contenida en el campo de la imagen
dropzone.on('removedfile', function(){
    //console.log('Archivo Eliminado');
    document.querySelector("[name='imagen']").value = "";
});