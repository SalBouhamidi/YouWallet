export function Register(){
    return(
        <>
        <h3 className="mt-5">Welcome to YouWallet</h3>
        <form>
                <div className="mb-3">
                    <label  className="form-label">Full Name</label>
                    <input type="text" className="form-control" />
                </div>
                <div className="mb-3">
                    <label for="exampleInputEmail1" className="form-label">Email address</label>
                    <input type="email" className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"/>
                </div>
                <div className="mb-3">
                    <label for="exampleInputPassword1" className="form-label">Password</label>
                    <input type="password" className="form-control" id="exampleInputPassword1"/>
                </div>
                <div className="mb-3">
                    <label for="exampleInputPassword1" className="form-label">Repeat Password</label>
                    <input type="password" className="form-control" id="exampleInputPassword1"/>
                </div>

            <button type="submit" className="btn btn-submit text-light">Submit</button>
        </form>
        </>
    )
}