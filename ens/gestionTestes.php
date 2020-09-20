
    <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item nav-link active" ><a role="tab" aria-controls="ajoutTest" aria-selected="true" data-toggle="tab"  href="#ajoutDoc">Ajouter un teste </a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#listeTest">Liste des testes</a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#resultTest">Résultats des testes</a></li>
    </ul>
<div class="tab-content">
                    <div id="ajoutTest" class="tab-pane fade show active">
                        <div class="offset-md-3 col-md-6">
                            <form action="#">
                                <div class="form-group">
                                    <h5>Type de test</h5>
                                    <select name="typeTeste" id="typeTeste" class="form-control" required>
                                        <option value="docPrlivreincipale">Livre</option>
                                        <option value="tuto">Tutoriel</option>
                                    </select>

                                </div>
                             
                                <br>
                                <center>
                                    <button class="btn btn-primary" style="width:50%;">Ajouter</button>
                                </center>
                            </form>
                        </div>
                    </div>
                    <div id="listeTest" class="tab-pane fade">
                    <div class="container">
                        
                        <div class="table-responsive">
                            <table id="productsTable" class="table table-bordered" style="text-align:center">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Détail</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <tr>
                                    <th scope="row"></th>
                                        <td><img src="data:image/png;base64,{{ chunk_split(base64_encode($product->image)) }}" height="100px" alt=""></td>
                                        <td></td>
                                    <td><a href="{{route('admin.variation',$product->id)}}" class="btn btn-primary">Détail </a></td>
                                        <td>
                                            <button class="btn btn-info showEditProduct" data-toggle="modal" data-target="#editProductModal" data-id="{{$product->id}}" ><i class="fas fa-edit"></i></button>
                                        </td>
                                    <td>
                                        <center>
                                        <button class="btn btn-primary showVariationModal" data-toggle="modal" data-target="#addVariationModal" data-id="{{$product->id}}"> <i class="fas fa-plus-square"></i> </button></td>
                                    </center>
                                        <td>
                                            <center>
                                        <a href="{{route('productDelete',$product->id)}}" class="btn btn-danger text-white">
                                            <i class="far fa-trash-alt"></i></a>
                                        </center>
                                        </td>
                                    </tr>
                            


                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                    <div id="resultTest" class="tab-pane fade">
                    <div class="container">
                        
                        <div class="table-responsive">
                            <table id="productsTable" class="table table-bordered" style="text-align:center">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Aprenant</th>
                                    <th scope="col">Test</th>
                                    <th scope="col">Détail</th>
                                    <th scope="col">Note</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <tr>
                                    <th scope="row"></th>
                                        <td><img src="data:image/png;base64,{{ chunk_split(base64_encode($product->image)) }}" height="100px" alt=""></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      <td>
                                            <button class="btn btn-info showEditProduct" data-toggle="modal" data-target="#editProductModal" data-id="{{$product->id}}" ><i class="fas fa-edit"></i></button>
                                        </td>
                                    <td>
                                        <center>
                                        <button class="btn btn-primary showVariationModal" data-toggle="modal" data-target="#addVariationModal" data-id="{{$product->id}}"> <i class="fas fa-plus-square"></i> </button></td>
                                    </center>
                                        <td>
                                            <center>
                                        <a href="{{route('productDelete',$product->id)}}" class="btn btn-danger text-white">
                                            <i class="far fa-trash-alt"></i></a>
                                        </center>
                                        </td>
                                    </tr>
                            


                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
</div>