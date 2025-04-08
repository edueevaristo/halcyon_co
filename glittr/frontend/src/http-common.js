import axios from "axios";

const http = axios.create({
    baseURL: "https://localhost", //Configurada somente localhost até termos a URL da API.
    headers: {
        "Content-Type": "application/json"
    }
});

http.interceptors.request.use(config => {

    const token = localStorage.getItem('token');

    if (token) {

        config.headers['Authorization'] =  `Bearer ${token}`//Configurada padrão.
    }

    return config;

}, error => {

    return Promise.reject(error);
    
});

export default http;