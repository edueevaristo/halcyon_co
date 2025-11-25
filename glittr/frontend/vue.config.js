module.exports = {
    devServer: {
        proxy: {
            '/api': {
                target: 'http://3.21.55.156',
                changeOrigin: true,
            },
        },
    },
};