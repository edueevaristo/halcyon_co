<!DOCTYPE html>
<html>
<head>
    <title>Solicitação de Acesso Premium</title>
</head>
<body>
    <h2>Nova Solicitação de Acesso Premium</h2>
    
    <p><strong>ID do Usuário:</strong> {{ $user_id }}</p>
    <p><strong>Nome:</strong> {{ $user_name }}</p>
    <p><strong>Email:</strong> {{ $user_email }}</p>
    <p><strong>Ação Solicitada:</strong> {{ $action }}</p>
    <p><strong>Data/Hora da Solicitação:</strong> {{ $requested_at }}</p>
    
    <p>O usuário tentou acessar uma funcionalidade premium e solicitou acesso.</p>
</body>
</html>