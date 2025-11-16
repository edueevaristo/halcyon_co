<!DOCTYPE html>
<html>
<head>
    <title>Solicitação de Acesso Premium - Glittr</title>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #ED008C;">🌟 Nova Solicitação de Acesso Premium</h2>
        
        <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p><strong>ID do Usuário:</strong> {{ $user_id }}</p>
            <p><strong>Nome:</strong> {{ $user_name }}</p>
            <p><strong>Email:</strong> {{ $user_email }}</p>
            <p><strong>Funcionalidade Solicitada:</strong> {{ $action }}</p>
            <p><strong>Data/Hora:</strong> {{ $requested_at }}</p>
        </div>
        
        <p>Um usuário tentou acessar uma funcionalidade premium e solicitou acesso à plataforma Glittr.</p>
        
        <hr style="margin: 20px 0;">
        <p style="font-size: 12px; color: #666;">Este e-mail foi enviado automaticamente pela plataforma Glittr.</p>
    </div>
</body>
</html>