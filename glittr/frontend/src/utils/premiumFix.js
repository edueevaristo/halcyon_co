// Script para corrigir dados premium no frontend
export async function refreshPremiumStatus() {
    try {
        const token = localStorage.getItem('token');
        if (!token) {
            console.log('Usuário não logado');
            return false;
        }

        const hostname = window.location.hostname;
        const baseUrl = (hostname === 'localhost' || hostname === '127.0.0.1') 
            ? 'http://127.0.0.1:8000/api' 
            : 'https://api.glittr.com.br/api';

        // Buscar dados atualizados do usuário
        const response = await fetch(`${baseUrl}/user/refresh-premium`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        });

        if (response.ok) {
            const data = await response.json();
            
            // Atualizar localStorage
            localStorage.setItem('user', JSON.stringify(data.user));
            localStorage.setItem('user_id', data.user.id);
            localStorage.setItem('email', data.user.email);
            
            console.log('✅ Dados premium atualizados:', data.user);
            console.log('Is Premium:', data.user.is_premium);
            
            // Forçar reload da página para aplicar mudanças
            window.location.reload();
            
            return data.user.is_premium;
        } else {
            console.error('Erro ao atualizar dados premium');
            return false;
        }
    } catch (error) {
        console.error('Erro:', error);
        return false;
    }
}

// Função para verificar status premium atual
export function checkCurrentPremiumStatus() {
    try {
        const userData = localStorage.getItem('user');
        if (userData) {
            const user = JSON.parse(userData);
            console.log('Dados atuais do usuário:', user);
            console.log('Is Premium:', user.is_premium);
            return user.is_premium;
        } else {
            console.log('Nenhum dado de usuário encontrado no localStorage');
            return false;
        }
    } catch (error) {
        console.error('Erro ao verificar status premium:', error);
        return false;
    }
}

// Executar automaticamente quando importado
if (typeof window !== 'undefined') {
    // Adicionar função global para debug
    window.refreshPremiumStatus = refreshPremiumStatus;
    window.checkCurrentPremiumStatus = checkCurrentPremiumStatus;
    
    console.log('🔧 Premium Fix carregado. Use:');
    console.log('- window.checkCurrentPremiumStatus() para verificar status atual');
    console.log('- window.refreshPremiumStatus() para atualizar dados');
}