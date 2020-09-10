
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('css/login.css')?>" type="text/css"> 
    <title>Productos a comprar</title>
</head>
<body>
    
    <table class="table table-dark">                         
      <thead>
        <td scope="row" style=" color: rgb(56, 199, 199);"><h2>Productos en espera de ser comprados</h2></td>
        <tr>                       
          <th scope="col" style=" color: rgb(56, 199, 199)">NOMBRE</th>
            <th scope="col" style=" color: rgb(56, 199, 199)">PRECIO</th>
            <th scope="col" style=" color: rgb(56, 199, 199)">ELIMINAR</th>                            
        </tr>
          @foreach ($producto as $cat) 
            <tr>
              <td scope="row">{{$cat->nombre}}</td>
              <td scope="row">{{$cat->monto}}</td>
              <td scope="row"><a href="{{route('eliProSel',$cat)}}">✖️</a> </td>
            <tr>
          @endforeach 
            <tr>
              <td scope="row">Total de compra: {{ $total}}</td>
            </tr>
            <td class="botones" scope="row">
              <a style="color: white" href="{{route('cliente')}}"><button type="button" class="btn btn-danger"> Volver a la tienda</button></a>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong">Facturar productos</button>
            </td>
      </thead>
      <tbody>
      </tbody>
    </table>
 

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Factura de compra</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
              </div>
                <div class="modal-body">
                  <table class="table ">                                                          
                    <td scope="row" style=" color: rgb(56, 199, 199);">
                      <h2>JP STORE CR</h2>                                       
                    </td>
                    <tr>                                                                                             
                    </tr>
                    @foreach ($producto as $cat) 
                      <tr>
                        <td scope="row">{{$cat->nombre}}</td>
                        <td scope="row">{{$cat->monto}}</td>
                      <tr>
                    @endforeach 
                      <tr>
                        <td scope="row" style=" color: rgb(56, 199, 199);">Total: {{ $total}}</td>
                      </tr>                                                                      
                      <tbody>                                   
                      </tbody>
                  </table>
                </div>                       
                  <a  style="color: white; text-align: right;" href="{{route('productoComprado')}}"> <button type="button" class="btn btn-success"> Confirmar compra</button></a>                                          
              </div>
            </div>
          </div>

</body>
</html>
  
  