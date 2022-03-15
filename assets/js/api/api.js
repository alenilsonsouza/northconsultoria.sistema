// Função para ser usar em todas as requisições
const request = async (method, endpoint, params, token = null) => {
    method = method.toLowerCase();
    let fullUrl = `${BASE_API}${endpoint}`;
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
    let json = await req.json();
    return json;
}

const Api = {
    getToken: () => {
        return localStorage.getItem('token');
    },
    validateToken: async () => {
        let token = localStorage.getItem('token');
        let json = await request('post', '/auth/validate', {}, token);
        return json;
    },
    login: async (email, password) => {
        let json = await request('post', '/auth/login', { email, password });
        return json;
    },
    logout: async () => {
        let json = await request('post', '/auth/logout', {}, null);
        localStorage.removeItem('token');
        return json;
    },
    getRegisterOne: async (id, type) => {
        let json = await request('get', `/register/${id}/${type}`, {}, null);
        return json;
    },
    addRegister: async (data) => {
        let json = await request('post', `/registerpeople`, data, null);
        return json;
    },
    getPlanOne: async (id) => {
        let json = await request('get', `/plan/${id}`, {}, null);
        return json;
    },
    verifyCPFExists: async (cpf) => {
        let json = await request('get', `/verifycpf/${cpf}`, {}, null);
        return json;
    },
    verifyEmailExists: async (email) => {
        let json = await request('get', `/verifyemail/${email}`, {}, null);
        return json;
    },
    addAddress: async (data) => {
        let json = await request('post', `/address`, data, null);
        return json;
    },
    addFile: async (data) => {
        let formData = new FormData();
        formData.append('id_people', data.id_people);
        formData.append('file', data.file);
        formData.append('type', data.type);
        let req = await fetch(`${BASE_API}/file`, {
            method: 'POST',
            body: formData
        });
        let json = await req.json();
        return json;
    },
    
}