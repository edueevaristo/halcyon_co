import axios from "axios";

const getBaseURL = () => {
    // SEMPRE força HTTP, independente do protocolo da página
    const hostname = window.location.hostname;

    if (hostname === 'localhost' || hostname === '127.0.0.1') {
        return "http://127.0.0.1:8000/api";
    }

    // Usar domínio com HTTPS
    return "https://api.glittr.com.br/api";
};

const http = axios.create({
    baseURL: getBaseURL(),
    headers: {
        "Content-Type": "application/json"
    }
});

http.interceptors.request.use(config => {
    // Força HTTP na URL
    if (config.url && config.url.startsWith('https://3.137.94.17')) {
        config.url = config.url.replace('https://', 'http://');
    }
    if (config.baseURL && config.baseURL.startsWith('https://3.137.94.17')) {
        config.baseURL = config.baseURL.replace('https://', 'http://');
    }

    const token = localStorage.getItem('token');

    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`
    }

    if (config.data instanceof FormData) {
        delete config.headers['Content-Type'];
    }

    return config;

}, error => {
    return Promise.reject(error);
});

export default http;