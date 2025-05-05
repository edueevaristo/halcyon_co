import http from "@/http-common";

class PostSubcategoryDataService {

    async getById(id) {
        try {
            return await http.get(`/subcategories/${id}`);

        } catch (error) {

            console.error(`Erro ao buscar subcategoria com id ${id}:`, error);
            throw error;
        }
    }


    async getAll() {

        try {

            return await http.get(`/subcategories`);

        } catch (error) {

            console.error("Erro ao buscar subcategorias:", error);
            throw error;
        }
    }

}

export default new PostSubcategoryDataService();