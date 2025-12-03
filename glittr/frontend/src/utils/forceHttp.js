// Utilitário para forçar HTTP em todas as requisições
export const forceHttpUrl = (url) => {
  if (typeof url !== 'string') return url;
  
  // Se a URL contém o IP do servidor, força HTTP
  if (url.includes('3.137.94.17')) {
    return url.replace(/^https:\/\//, 'http://');
  }
  
  return url;
};

// Intercepta fetch global para forçar HTTP
const originalFetch = window.fetch;
window.fetch = function(url, options = {}) {
  const forcedUrl = forceHttpUrl(url);
  console.log('Fetch intercepted:', url, '->', forcedUrl);
  return originalFetch(forcedUrl, options);
};

// Intercepta XMLHttpRequest para forçar HTTP
const originalOpen = XMLHttpRequest.prototype.open;
XMLHttpRequest.prototype.open = function(method, url, ...args) {
  const forcedUrl = forceHttpUrl(url);
  console.log('XHR intercepted:', url, '->', forcedUrl);
  return originalOpen.call(this, method, forcedUrl, ...args);
};

console.log('🔧 HTTP Force loaded - All requests to 3.137.94.17 will use HTTP');