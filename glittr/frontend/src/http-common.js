import axios from "axios";

const getBaseURL = () => {

    const hostname = window.location.hostname;

    if (hostname === 'localhost' || hostname === '127.0.0.1') {

        return "http://127.0.0.1:8000/api";
    }

    return "https://halcyon-co.onrender.com/api";
};

const http = axios.create({
    baseURL: getBaseURL(),
    headers: {
        "Content-Type": "application/json"
    }
});

http.interceptors.request.use(config => {

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