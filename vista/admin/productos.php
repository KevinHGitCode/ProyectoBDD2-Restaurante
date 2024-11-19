<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Productos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .product-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .product-card-body {
            padding: 20px;
            text-align: center;
        }
        .product-name {
            font-size: 1.6rem;
            font-weight: bold;
            color: #333;
        }
        .product-description {
            color: #555;
            font-size: 1rem;
            margin-bottom: 15px;
        }
        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .category-tag {
            background-color: #28a745;
            color: #fff;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 50px;
            padding: 5px 15px;
            margin-top: 10px;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center mb-5">Menú de Productos</h1>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Producto 1 -->
            <div class="col">
                <div class="card product-card">
                    <img src="https://jetextramar.com/wp-content/uploads/2021/07/congelados-receta-hamburguesa-de-pollo.jpg" alt="Hamburguesa Clásica" class="product-img">
                    <div class="card-body product-card-body">
                        <h5 class="product-name">Hamburguesa Clásica</h5>
                        <p class="product-description">Hamburguesa de res con lechuga, tomate, queso y salsa especial.</p>
                        <p class="price">$18,000 COP</p>
                        <p class="category-tag">Categoría: 2</p>
                    </div>
                </div>
            </div>

            <!-- Producto 2 -->
            <div class="col">
                <div class="card product-card">
                    <img src="https://www.clarin.com/img/2023/08/01/SL3EslnOA_1200x630__1.jpg" alt="Pizza Margarita" class="product-img">
                    <div class="card-body product-card-body">
                        <h5 class="product-name">Pizza Margarita</h5>
                        <p class="product-description">Pizza con base de tomate, queso mozzarella y albahaca.</p>
                        <p class="price">$25,000 COP</p>
                        <p class="category-tag">Categoría: 2</p>
                    </div>
                </div>
            </div>

            <!-- Producto 3 -->
            <div class="col">
                <div class="card product-card">
                    <img src="https://i.ytimg.com/vi/Zqxt9tvK5EI/maxresdefault.jpg" alt="Ensalada César" class="product-img">
                    <div class="card-body product-card-body">
                        <h5 class="product-name">Ensalada César</h5>
                        <p class="product-description">Ensalada con lechuga romana, crutones, parmesano y aderezo César.</p>
                        <p class="price">$15,000 COP</p>
                        <p class="category-tag">Categoría: 2</p>
                    </div>
                </div>
            </div>

            <!-- Producto 4 -->
            <div class="col">
                <div class="card product-card">
                    <img src="https://alqueria.com.co/sites/default/files/receta-de-sopa-de-tomate_3_0.jpg" alt="Sopa de Tomate" class="product-img">
                    <div class="card-body product-card-body">
                        <h5 class="product-name">Sopa de Tomate</h5>
                        <p class="product-description">Sopa cremosa de tomate con hierbas frescas.</p>
                        <p class="price">$12,000 COP</p>
                        <p class="category-tag">Categoría: 1</p>
                    </div>
                </div>
            </div>

            <!-- Producto 5 -->
            <div class="col">
                <div class="card product-card">
                    <img src="https://img.freepik.com/fotos-premium/deliciosos-tacos-gourmet-pollo-parrilla-pina-hierbas-frescas-salsa-mesa-madera_996993-11573.jpg" alt="Tacos de Pollo" class="product-img">
                    <div class="card-body product-card-body">
                        <h5 class="product-name">Tacos de Pollo</h5>
                        <p class="product-description">Tacos de pollo con guacamole, lechuga y queso.</p>
                        <p class="price">$20,000 COP</p>
                        <p class="category-tag">Categoría: 2</p>
                    </div>
                </div>
            </div>

            <!-- Producto 6 -->
            <div class="col">
                <div class="card product-card">
                    <img src="https://img.freepik.com/fotos-premium/sandwich-gourmet-pavo-arandanos-sobre-tabla-madera-estampada_419341-130715.jpg" alt="Sandwich de Pavo" class="product-img">
                    <div class="card-body product-card-body">
                        <h5 class="product-name">Sandwich de Pavo</h5>
                        <p class="product-description">Sandwich con pavo, lechuga, tomate y mayonesa.</p>
                        <p class="price">$13,000 COP</p>
                        <p class="category-tag">Categoría: 1</p>
                    </div>
                </div>
            </div>

            <!-- Producto 7 -->
            <div class="col">
                <div class="card product-card">
                    <img src="https://img.freepik.com/fotos-premium/fettuccine-alfredo-pasta-italiana-mantequilla-queso-parmesano-sobre-fondo-blanco_492434-222.jpg" alt="Pasta Alfredo" class="product-img">
                    <div class="card-body product-card-body">
                        <h5 class="product-name">Pasta Alfredo</h5>
                        <p class="product-description">Pasta en salsa Alfredo con trozos de pollo.</p>
                        <p class="price">$22,000 COP</p>
                        <p class="category-tag">Categoría: 1</p>
                    </div>
                </div>
            </div>

            <!-- Producto 8 -->
            <div class="col">
                <div class="card product-card">
                    <img src="https://img.freepik.com/fotos-premium/jugo-mango-jarro-rebanadas-mango-fresco-mejor-fotografia-imagenes-jugo-manga-fresco_1020697-58667.jpg" alt="Jugo Natural de Mango" class="product-img">
                    <div class="card-body product-card-body">
                        <h5 class="product-name">Jugo Natural de Mango</h5>
                        <p class="product-description">Jugo fresco de mango sin azúcar añadida.</p>
                        <p class="price">$8,000 COP</p>
                        <p class="category-tag">Categoría: 4</p>

                    </div>
                </div>
            </div>

        </div> <!-- Fin del row -->

    </div> <!-- Fin del container -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
