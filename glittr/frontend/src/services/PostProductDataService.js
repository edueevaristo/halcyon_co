import http from "@/http-common";

class PostProductDataService {

    async getById(id) {

        try {

            return await http.get(`/products/${id}`);

        } catch (error) {

            console.error(`Erro ao buscar produto com id ${id}:`, error);
            throw error;
        }
    }


    async insert(formData) {

        try {

            return await http.post("/products", formData, {
                headers: {"Content-Type": "multipart/form-data"},
            });

        } catch (error) {

            console.error("Erro ao cadastrar produto:", error);
            throw error;
        }
    }

    async update(id, formData) {

        try {

            return await http.post(`/products/${id}?_method=PUT`, formData, {
                headers: {"Content-Type": "multipart/form-data"},
            });

        } catch (error) {

            console.error(`Erro ao atualizar produto com id ${id}:`, error);
            throw error;
        }
    }

}

export default new PostProductDataService();
