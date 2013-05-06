<?

$user = new CityshopsUser;

$user->guid = "1e25bd48698b2745bd411e2bc801fa1490076ed76ed";

$user->authenticateUser();
echo "<div class=\"well\">";

echo '<a href="' . $user->guid_login_url . '">Auth user</a>';
echo "</div>";