import http from "@/http-common";

class PostFeedbackDataService {

    async toggleReviewLike(reviewId) {
        try {
            return await http.post(`/reviews/${reviewId}/like`);
        } catch (error) {
            console.error("Erro ao dar like na review:", error);
            throw error;
        }
    }

    async getReplies(reviewId) {
        try {
            return await http.get(`/reviews/${reviewId}/replies`);
        } catch (error) {
            console.error("Erro ao buscar respostas:", error);
            throw error;
        }
    }

    async createReply(reviewId, reply) {
        try {
            return await http.post(`/reviews/${reviewId}/replies`, { reply });
        } catch (error) {
            console.error("Erro ao criar resposta:", error);
            throw error;
        }
    }

    async toggleReplyLike(replyId) {
        try {
            return await http.post(`/replies/${replyId}/like`);
        } catch (error) {
            console.error("Erro ao dar like na resposta:", error);
            throw error;
        }
    }

    async getMentionableUsers(productId) {
        try {
            return await http.get(`/products/${productId}/mentionable-users`);
        } catch (error) {
            console.error("Erro ao buscar usuários mencionáveis:", error);
            throw error;
        }
    }

    getImageUrl(imagePath) {
        if (!imagePath) return require('@/assets/icons/LogoGlittr.svg');
        if (imagePath.startsWith('http')) return imagePath;
        
        const hostname = window.location.hostname;
        const baseUrl = (hostname === 'localhost' || hostname === '127.0.0.1') 
            ? 'http://127.0.0.1:8000' 
            : 'http://18.222.253.169';
            
        const cleanPath = imagePath.replace(/^\/storage\//, '');
        return `${baseUrl}/storage/${cleanPath}`;
    }
}

export default new PostFeedbackDataService();