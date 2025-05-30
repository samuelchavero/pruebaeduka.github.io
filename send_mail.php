<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Valida que los campos no estén vacíos
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor, completa todos los campos del formulario y asegúrate de que el email sea válido.";
        exit;
    }

    // Configura el destinatario del correo
    $recipient = "Info@somoseduka.com"; // CAMBIA ESTO A TU EMAIL
    $subject = "Nuevo mensaje de contacto desde Somos Eduka";

    // Contenido del correo
    $email_content = "Nombre: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensaje:\n$message\n";

    // Encabezados del correo
    $email_headers = "From: $name <$email>";

    // Envía el correo
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "¡Gracias! Tu mensaje ha sido enviado.";
    } else {
        http_response_code(500);
        echo "Oops! Algo salió mal y no pudimos enviar tu mensaje.";
    }

} else {
    http_response_code(403);
    echo "Hubo un problema con tu envío, por favor intenta de nuevo.";
}
?>
