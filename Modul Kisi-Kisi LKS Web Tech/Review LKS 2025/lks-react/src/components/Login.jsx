export default function Login(){
    return(
        <div>
      <nav className="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
    <div className="container container-login">
        <a className="navbar-brand" href="#">Job Seekers Platform</a>
        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
        </button>

        <div className="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul className="navbar-nav ml-auto">
                <li className="nav-item">
                    <a className="nav-link" href="#">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main classNameName="d-flex justify-center items-center">

    <div className="container form-login">
        <div className="row justify-content-center items-center">
            <div className="col-md-6">
                <form className="card card-default">
                    <div className="card-header container-form">
                        <h4 className="mb-0">Job Seeker Platform</h4>
                    </div>
                    <div className="card-body">
                        <div className="form-group row-column align-items-center">
                            <div className="col-4 text-left mb-2">Nomor Ktp</div>
                            <div className="col-8"><input type="text" className="form-control" /></div>
                        </div>
                        <div className="form-group row-column align-items-start">
                            <div className="col-4 text-left mb-2">Kata Sandi</div>
                            <div className="col-8"><input type="password" className="form-control" /></div>
                        </div>
                        <div className="form-group row mt-4">
                            {/* <div className="col-4"></div> */}
                            <div className="col-6 ml-3"><button className="btn btn-primary btn-login">Login</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
      </div>
    );
}