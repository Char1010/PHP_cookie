<?php



// ADD TO CART
if(isset($_POST['add_to_cart']))
{
    // Si le cookie existe
    if(isset($_COOKIE['shopping_cart']))
    {
        // on recupere les infos du cookie
        $cookie_data = $_COOKIE['shopping_cart'];
        // on decode les infos du cookie
        $cart_data = json_decode($cookie_data, true);
    } else {
        // si non, on cree un tableau cart_data
        $cart_data = array();
    }

    $item_list = array_column($cart_data, 'hidden_id');
     //var_dump($item_list); // Liste des ID dans le panier
     //var_dump($cart_data); // Liste des produits
    // die();

    // Si l'ID du produit est dans le tableau
    if(in_array($_POST["hidden_id"], $item_list))
    {
        // On parcours le tableau
        foreach($cart_data as $k => $v)
        {
            // Si l<ID du tableau est egal a l'ID du produit
            if($cart_data[$k]["hidden_id"] == $_POST["hidden_id"])
            {
                // on mets a jour la quantite du produit
                $cart_data[$k]["quantity"] = $cart_data[$k]["quantity"] + $_POST["quantity"];
            }
        }
    } else {
        // On cree un tableau avec les informations du produit
        $item_array = array(
            'hidden_id' => $_POST['hidden_id'],
            'hidden_name' => $_POST['hidden_name'],
            'hidden_price' => $_POST['hidden_price'],
            'quantity' => $_POST['quantity']
        );
        // on ajoute l'item dans le panier
        $cart_data[] = $item_array;

} 
    // on encode les items en JSON
    $item_data = json_encode($cart_data);
    // On cree un cookie avec l'info sous forme de JSON pour 30 jours
    setcookie('shopping_cart', $item_data, time() + (86400 * 30));
    // On redirige l'utilisateur
    header("location:index.php?success=1");
}

// DELETE ALL
if(isset($_GET["action"]) == "clear")
{
   setcookie("shopping_cart","", time() -3600);
   header("location:index.php?clearAll=1");
}
// DELETE SPECIFIC PRODUCT [element2]
if(isset($_GET["action"]) == "delete")
{
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $k => $v) {
        if($cart_data[$k]["hidden_id"] == $_GET['id']) {
            unset($cart_data[$k]);
            $item_data = json_encode($cart_data);
            setcookie('shopping_cart', $item_data, time() + (86400 *30));
            header("location:index.php?remove=1");
        }
    }
}

// MSG FOR ADD TO CART
if(isset($_GET['success']))
{
    $message = '
    <div>
        le produit a ete ajouter avec succes
    </div>
    ';
}

// MSG FOR DELETE PRODUCT
if(isset($_GET['remove']))
{
    $message = '
    <div>
        le produit a ete enlever avec succes
    </div>
    ';
}

// MSG FOR DELETE ALL
if(isset($_GET['clearAll']))
{
    $message = '
    <div>
        le panier a ete vider
    </div>
    ';
}



