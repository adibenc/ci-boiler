class Ajaxer{
    statusCodeHandler = {}

    constructor(){
        this.setDefaultStatusCodeHandler()
    }

	getStatusCodeHandler() {
		return this.statusCodeHandler;
	}

	setStatusCodeHandler(statusCodeHandler) {
        this.statusCodeHandler = statusCodeHandler;
        
        return this
    }
    
    setDefaultStatusCodeHandler(){
        return this.setStatusCodeHandler({
            500: function() {
                alert("Error 500");
            }
        })
    }

    withCsrf(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // Authorization: "Bearer "+access_token
            }
        });

        return this
    }
    // "GET"
    doReq(method, url, data, succCallback = null, errCallback = null){
        let ctx = this
        if(!succCallback){
            succCallback = this.defaultC1()
        }
        if(!errCallback){
            errCallback = this.defaultE1()
        }
        return $.ajax({
            type: method,
            url: url,
            cache: false,
            data: data,
            success: succCallback,
            processData: false,
            contentType: false,
            error: errCallback,
            statusCode: ctx.getStatusCodeHandler()
        });
    }

    defaultC1(){
        return function(response) {
            
        }
    }
    
    defaultE1(){
        return function(xhr) {
            alert(xhr.responseJSON.message);
        }
    }

    get(url, data, succCallback = null, errCallback = null){
        return this.doReq("GET", url, data, succCallback, errCallback)
    }

    post(url, data, succCallback = null, errCallback = null){
        console.log(data)
        return this.doReq("POST", url, data, succCallback, errCallback)
    }

    put(url, data, succCallback = null, errCallback = null){
        data._method = "PUT"
        return this.doReq("PUT", url, data, succCallback, errCallback)
    }

    patch(url, data, succCallback = null, errCallback = null){
        data._method = "PATCH"
        // console.log(data)
        data.append("_method", "PATCH");
        return this.doReq("PATCH", url, data, succCallback, errCallback)
    }

    delete(url, data, succCallback = null, errCallback = null){
        return this.doReq("DELETE", url, data, succCallback, errCallback)
    }
}

class CSRFFormData extends FormData{
    constructor(param){
        super(param)
        // csrf-name
        this.append(
            $('meta[name="csrf-name"]').attr('content'),
            $('meta[name="csrf-token"]').attr('content'),
        )
    }
}

var ajaxer = null;

if(true){
    ajaxer = new Ajaxer();
}

/*

var ajaxer = new Ajaxer()
// declare if with x-csrf
ajaxer.withCsrf()

ajaxer.get( callurl , null, 
    function(response){
        if(response.success){
            
        }else{
            console.log(response.message)
        }
    },
)
*/