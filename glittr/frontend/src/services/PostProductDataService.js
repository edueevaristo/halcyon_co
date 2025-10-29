import http from "@/http-common";

class PostProductDataService {

    async getById(id) {

        try {
            const token = localStorage.getItem('token');
            const headers = token ? { "Authorization": "Bearer " + token } : {};
            
            return await http.get(`/products/show/${id}`, { headers });

        } catch (error) {

            console.error(`Erro ao buscar produto com id ${id}:`, error);
            throw error;
        }
    }

    async getAll(page = 1, perPage = 12) {

        try {

            return await http.get(`/products?page=${page}&per_page=${perPage}`);

        } catch (error) {

            console.error("Erro ao buscar produtos:", error);
            throw error;
        }
    }

    async getAllByCategory(id) {

        try {

            return await http.get(`/products/show/category/${id}`);

        } catch (error) {

            console.error(`Erro ao buscar produtos da categoria com id ${id}:`, error);
            throw error;
        }
    }

    async getAllBySubCategory(category, subcategory) {

        try {

            return await http.get(`/products/show/subcategory/${category}/${subcategory}`);

        } catch (error) {

            console.error(`Erro ao buscar produtos da subcategoria com id da categoria ${category} e id da subcategoria ${subcategory}:`, error);
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
