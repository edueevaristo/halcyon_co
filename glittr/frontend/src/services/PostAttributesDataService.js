import http from "@/http-common";

class PostAttributesDataService {

    async getBySubCategory(id) {

        try {
            return await http.get(`/attributes/show/subcategory/${id}`);

        } catch (error) {

            console.error(`Erro ao buscar atributo com id da subcategoria informado: ${id}:`, error);
            throw error;
        }
    }

    async getAll() {

        try {

            return await http.get(`/attributes`);

        } catch (error) {

            console.error("Erro ao buscar categorias:", error);
            throw error;
        }
    }

    async getById(id) {

        try {

            return await http.get(`/attributes/show/${id}`);
        } catch (error) {

            console.error(`Erro ao buscar atributo com id informado: ${id}:`, error);
            throw error;
        }
    }

    async getValuesById(id) {

        try {

            return await http.get(`/attributes/values/${id}`);

        } catch (error) {
            console.error(`Erro ao buscar valores do atributo com id informado: ${id}:`, error);
            throw error;
        }
    }

}

export default new PostAttributesDataService();
