import http from "@/http-common";

class PostCategoryDataService {

    async getById(id) {
        try {
            return await http.get(`/categories/${id}`);

        } catch (error) {

            console.error(`Erro ao buscar categoria com id ${id}:`, error);
            throw error;
        }
    }

    async getAll() {

        try {

            return await http.get(`/categories`);

        } catch (error) {

            console.error("Erro ao buscar categorias:", error);
            throw error;
        }
    }

}

export default new PostCategoryDataService();
