module.exports = {
    devServer: {
        proxy: {
            '/api': {
                target: 'https://glittr.com.br',
                changeOrigin: true,
            },
        },
    },
};