<?php
// Include config file
include('./includes/class-autoload.inc.php');
require_once('./includes/config.php');

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Zadajte používateľské meno.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Používateľské meno môže obsahovať iba písmená, čísla, a podtržníky.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "Tento účet už existuje.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Niečo sa nepodarilo, skúste to neskôr.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Zadajte heslo.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Heslo musí mať aspoň 6 znakov.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Potvrďte heslo.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Heslá sa nezhodujú.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Niečo sa nepodarilo, skúste to neskôr.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<?php require_once('./shared/header.php') ?>

    <div class="container my-5">
        <h2 class="mb-3">Registrovať</h2>
        <div class="row">
            <div class="col-sm-6">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group mb-3">
                        <label>Používateľské meno</label>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group mb-3">
                        <label>Heslo</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group mb-2">
                        <label>Potvrďte heslo</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="terms-and-conditions overflow-scroll my-3" style="height: 150px">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum assumenda, ullam, sed quo ipsam officia
                            asperiores minima excepturi eveniet reiciendis velit debitis temporibus explicabo. Incidunt sit itaque,
                            reprehenderit fuga voluptatem officiis corrupti ipsa eveniet architecto dolorem magni facere doloribus aut
                            veritatis sequi quia repellendus aperiam assumenda exercitationem optio praesentium debitis. Excepturi unde
                            minus dignissimos at totam tempora beatae cumque, voluptates adipisci repudiandae asperiores repellat delectus
                            tempore voluptatem veritatis atque quaerat optio! Quasi, possimus molestiae hic modi quia minus eius veniam
                            aperiam assumenda fugiat fugit optio odio quas esse quam architecto officiis sunt quis cupiditate vel
                            voluptate
                            consequuntur nam porro harum. Fuga distinctio voluptate provident molestias perspiciatis fugit esse corrupti
                            adipisci quas eos dolor non cum ipsam repudiandae dolorem, quasi necessitatibus iusto unde similique
                            repellendus praesentium tenetur? Obcaecati aliquam nostrum vero expedita fuga, quae et quaerat modi error
                            adipisci eligendi fugit alias quia nihil laudantium quam tenetur ipsam explicabo nisi natus, rerum omnis,
                            debitis provident! Dolorum sequi recusandae, necessitatibus eos nesciunt cupiditate accusantium illum unde
                            minima. Labore sit quos voluptatem illum qui. Veritatis quis a mollitia asperiores repudiandae consequatur
                            assumenda, at tempora, modi voluptate sit blanditiis hic dignissimos harum consequuntur quia ipsam, architecto
                            nesciunt. Praesentium, mollitia? Delectus quod laudantium doloremque nihil?
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum assumenda, ullam, sed quo ipsam officia
                            asperiores minima excepturi eveniet reiciendis velit debitis temporibus explicabo. Incidunt sit itaque,
                            reprehenderit fuga voluptatem officiis corrupti ipsa eveniet architecto dolorem magni facere doloribus aut
                            veritatis sequi quia repellendus aperiam assumenda exercitationem optio praesentium debitis. Excepturi unde
                            minus dignissimos at totam tempora beatae cumque, voluptates adipisci repudiandae asperiores repellat delectus
                            tempore voluptatem veritatis atque quaerat optio! Quasi, possimus molestiae hic modi quia minus eius veniam
                            aperiam assumenda fugiat fugit optio odio quas esse quam architecto officiis sunt quis cupiditate vel
                            voluptate
                            consequuntur nam porro harum. Fuga distinctio voluptate provident molestias perspiciatis fugit esse corrupti
                            adipisci quas eos dolor non cum ipsam repudiandae dolorem, quasi necessitatibus iusto unde similique
                            repellendus praesentium tenetur? Obcaecati aliquam nostrum vero expedita fuga, quae et quaerat modi error
                            adipisci eligendi fugit alias quia nihil laudantium quam tenetur ipsam explicabo nisi natus, rerum omnis,
                            debitis provident! Dolorum sequi recusandae, necessitatibus eos nesciunt cupiditate accusantium illum unde
                            minima. Labore sit quos voluptatem illum qui. Veritatis quis a mollitia asperiores repudiandae consequatur
                            assumenda, at tempora, modi voluptate sit blanditiis hic dignissimos harum consequuntur quia ipsam, architecto
                            nesciunt. Praesentium, mollitia? Delectus quod laudantium doloremque nihil?
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum assumenda, ullam, sed quo ipsam officia
                            asperiores minima excepturi eveniet reiciendis velit debitis temporibus explicabo. Incidunt sit itaque,
                            reprehenderit fuga voluptatem officiis corrupti ipsa eveniet architecto dolorem magni facere doloribus aut
                            veritatis sequi quia repellendus aperiam assumenda exercitationem optio praesentium debitis. Excepturi unde
                            minus dignissimos at totam tempora beatae cumque, voluptates adipisci repudiandae asperiores repellat delectus
                            tempore voluptatem veritatis atque quaerat optio! Quasi, possimus molestiae hic modi quia minus eius veniam
                            aperiam assumenda fugiat fugit optio odio quas esse quam architecto officiis sunt quis cupiditate vel
                            voluptate
                            consequuntur nam porro harum. Fuga distinctio voluptate provident molestias perspiciatis fugit esse corrupti
                            adipisci quas eos dolor non cum ipsam repudiandae dolorem, quasi necessitatibus iusto unde similique
                            repellendus praesentium tenetur? Obcaecati aliquam nostrum vero expedita fuga, quae et quaerat modi error
                            adipisci eligendi fugit alias quia nihil laudantium quam tenetur ipsam explicabo nisi natus, rerum omnis,
                            debitis provident! Dolorum sequi recusandae, necessitatibus eos nesciunt cupiditate accusantium illum unde
                            minima. Labore sit quos voluptatem illum qui. Veritatis quis a mollitia asperiores repudiandae consequatur
                            assumenda, at tempora, modi voluptate sit blanditiis hic dignissimos harum consequuntur quia ipsam, architecto
                            nesciunt. Praesentium, mollitia? Delectus quod laudantium doloremque nihil?
                        </p>
                        <hr>
                    </div>
                    <div class="form-group mb-5">
                        <button type="submit" class="btn btn-primary accept" disabled autocomplete="off">Potvrdiť</button>
                        <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                    </div>
                    <p>Máte už účet? <a href="login.php">Prihláste sa</a>.</p>
                </form>
            </div>
            
        </div>
        
    </div>    

    <script src="./javascript/script.js"></script>

<?php require_once('./shared/footer.php') ?>