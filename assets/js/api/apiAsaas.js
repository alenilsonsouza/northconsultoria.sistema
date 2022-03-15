const headers = {
    'Access-Control-Allow-Origin': BASE_API_ASAAS,
    'Cache-Control' :'no-cache, no-store',
    'Content-Type': 'application/json',
    'access_token': APIKEY_ASAAS.trim().toString(),
};

// Função para ser usar em todas as requisições
const requestAsaas = async (method, endpoint, params) => {
    method = method.toLowerCase();
    let fullUrl = `${BASE_API_ASAAS}${endpoint}`;
    let body = null;
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
    let req = await fetch(fullUrl, { method, headers, body });
    let json = await req.json();
    return json;
}

const apiAsaas = {
    addClient: async (data) => {
        let json = await requestAsaas('post', `/api/v3/customers`, data);
        return json;
    },
    updateClient: async (data, id) => {

        let json = await requestAsaas('post', `/api/v3/customers/${id}`, data);
        return json;
    },
    getClientById: async (id) => {
        let json = await requestAsaas('get', `/api/v3/customers/${id}`, {});
        return json;
    },
    deleteClientById: async (id) => {
        let json = await requestAsaas('delete', `/api/v3/customers/${id}`, {});
        return json;
    },
    createPayment: async (data) => {
        let json = await requestAsaas('post', `/api/v3/payments`, data);
        return json;
    },
    addSubscription: async (data) => {
        let json = await requestAsaas('post', `/api/v3/subscriptions`, data);
        return json;
    },
    listSubscriptionByClient: async (id_costumer) => {
        let json = await requestAsaas('get', `/api/v3/subscriptions?customer=${id_costumer}`, {});
        return json;
    },
    listSubscriptionPayment: async (id) => {
        let json = await requestAsaas('get', `/api/v3/subscriptions/${id}/payments`, {});
        return json;
    },
    deleteSubscriptionById: async (id) => {
        let json = await requestAsaas('delete', `/api/v3/subscriptions/${id}`, {});
        return json;
    },

}