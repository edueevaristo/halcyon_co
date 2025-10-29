export const authorizedEmails = [
  'eduardo.evaristo@glittr.com.br',
  'amanda.vieira@glittr.com.br',
  'joao.pedro@glittr.com.br',
  'jenifer.goncalves@glittr.com.br',
  'daniel.oliveira@glittr.com.br'
];

export const isAuthorizedUser = () => {
  const email = localStorage.getItem('email');
  return email && authorizedEmails.includes(email);
};