module.exports = {
    devServer: {
        proxy: {
            '/api': {
                target: 'http://18.222.253.169',
                changeOrigin: true,
            },
        },
    },
};