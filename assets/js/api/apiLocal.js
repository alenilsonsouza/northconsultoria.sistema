const requestLocal = async (method, endpoint, params, token = null, toJson = true) => {
    method = method.toLowerCase();
    let fullUrl = `${BASE_URL}${endpoint}`;
    let body = null;
    // eslint-disable-next-line default-case
    switch (method) {
        case 'get':
            let queryString = new URLSearchParams(params).toString();
            fullUrl += `?${queryString}`;
            break;
        case 'put':
        case 'post':
        case 'delete':
            body = JSON.stringify(params);
            break;
    }
    let headers = { 'Content-Type': 'application/json' };
    if (token) {
        headers.Authorization = `Bearer ${token}`;
    }
    let req = await fetch(fullUrl, { method, headers, body });
    let json;
    if(toJson) {
        json = await req.json();
    } else {
        json = await req.text();
    }
    return json;
}

const apiLocal = {
    addClientToAsass: async (data) => {
        let json = await requestLocal('post', `/home/addClientAsaasInHome`, data, null);
        return json;
    },
    getClientsByConstumer: async (data) => {
        console.log('foi aqui');
        let json = await requestLocal('get', `ajax/relatoriovendas`, data, null, false);
        return json;
    },
}
