import http from "@/http-common";

class PostReviewDataService {

    async createReview(data) {

        try {

            return await http.post("/reviews", data);

        } catch (error) {

            console.error("Erro ao cadastrar review:", error);
            throw error;
        }
    }

    async updateReview(id, formData) {

        try {

            return await http.post(`/reviews/${id}?_method=PUT`, formData, {
                headers: {"Content-Type": "multipart/form-data", "Authorization": "Bearer " + localStorage.getItem('token')},
            });

        } catch (error) {

            console.error(`Erro ao atualizar review com id ${id}:`, error);
            throw error;
        }
    }

    async getAllForProduct(productId) {

        try {

            return await http.get(`/products/${productId}/reviews`);

        } catch (error) {

            console.error(`Erro ao buscar reviews do produto com id do produto informado: ${productId}:`, error);
            throw error;
        }
    }

    async getById(id) {

        try {

            return await http.get(`/reviews/${id}`);

        } catch (error) {

            console.error("Erro ao buscar review com id informado:", error);
            throw error;
        }
    }

}

export default new PostReviewDataService();
