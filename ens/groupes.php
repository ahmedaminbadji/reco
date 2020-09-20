
<div class="container">
<div class="container">
                        
                        <div class="table-responsive">
                            <table id="productsTable" class="table table-bordered" style="text-align:center">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom Groupe</th>
                                    <th scope="col">Image Groupe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <tr>
                                    <th scope="row"></th>
                                        <td><img src="data:image/png;base64,{{ chunk_split(base64_encode($product->image)) }}" height="100px" alt=""></td>
                                        <td></td>
                                       
                                    </tr>
                            


                                </tbody>
                            </table>
                        </div>
                    </div>
</div>