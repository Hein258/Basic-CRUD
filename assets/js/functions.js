function alertDialog(status = 'success', title, body, link = ''){

    if(link === ''){
        console.warn('Popup Notice : Refresh or redirect url is not set. Closing the popup will not do anything. \n * To refresh page: Set 4th variable to true. \n * To Redirect : Set 4th variable to url.');
    }

    if(!Swal){
        console.warn('Sweetalerts2 is not set');
    }
    else{

        Swal.fire({
            icon: status,
            title: title,
            html: body,
            willClose: () => {

                if(typeof link === "boolean" && link === true){
                    window.location = window.location.href;
                }
                else if(typeof link !== "boolean" && link !== ''){
                    window.location.href = link;
                }
            }

        });

    }

}