import axios from 'axios';

// Pentru POST
const headers = {
    // Am pus header default, ca sa o schimb daca e cazul
    'Content-Type': 'application/json'
};
const sendRequest = ((url, data = {}, headers = headers) => {
    let responseData = '';
    return axios.post(url, data, {headers})
        .then( response => {
            if (response.data.success){
                return response.data;
            }
            else {
                alert("Something went wrong");
            }
        }).catch( error => {
            console.log(error);
    });
    return responseData;
});

// Pentru GET
const sendGetRequest = ((url, params = {}) => {
    axios.get(url, {
        params
    }).then( response => {
        return response;
    }).catch( error => {
        console.log(error);
    });
});

export {sendRequest, sendGetRequest};
