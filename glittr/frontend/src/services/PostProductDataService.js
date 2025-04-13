import http from "@/http-common";

class PostProductDataService {

    getById(id) {

        return http.get(`/product/${id}`);
    }

    create(data) {

        return http.post("/product", data)
    }

    update(data, id) {

        return http.put(`/product/${id}`, data)
    }

}

export default new PostProductDataService();