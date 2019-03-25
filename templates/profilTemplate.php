
 <div class="container">
            <div class="row">
                <div class="col-md-12  toppad  offset-md-0 ">
				
                </div>
                <div class="col-md-6  offset-md-0  toppad" >
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Jose</h2>
                            <table class="table table-user-information ">
                                <tbody>
                                    <tr>
                                        <td>1er Apellido:</td>
                                        <td>Perez</td>
                                    </tr>
                                    <tr>
                                        <td>2do Apellido:</td>
                                        <td>Lopez</td>
                                    </tr>
                                    <tr>
                                        <td>Cargo:</td>
                                        <td>Empleado</td>
                                    </tr>
                                    <tr>
                                        <td>Alta:</td>
                                        <td>12/02/2017</td>
                                    </tr>
                                    <tr>
                                        <td>NIF:</td>
                                        <td>a14523687w</td>
                                    </tr>                                                
                                    <tr>
                                        <td>Codigo Postal:</td>
                                        <td>
                                            <input
                                                name="zipCode"
                                                type="text"
                                                label="08XXX"
                                                maxLength="5"
                                                value=08123
                                                focus
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>
                                            <input
                                                icon="email-icon"
                                                name="email"
                                                type="email"
                                                label=""
                                                value=joseperez@frjn.com
                                                focus
                                            />
                                        </td>
                                    </tr>
                                    <tr>

                                    <td>Telefono</td>
                                        <td>
                                            <input
                                                icon="email-icon"
                                                name="email"
                                                type="email"
                                                label=""
                                                value={123456789}
                                                focus
                                            />
                                        </td>                                                        
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" onClick={props.handleSubmitProfile} class="btn btn-primary ml-2">Guardar cambios</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>