import React from "react"
export default class Transations extends React.Component{
render(){
    return (
        <>
 <h3 className="mt-5">Welcome to YouWallet Transaction</h3>
        <p>Sending Money</p>
        <form>
                <div className="mb-3">
                    <label  className="form-label">Montant</label>
                    <input type="float" className="form-control" id="montant" />
                </div>
                <div className="mb-3">
                    <label className="form-label">Motif</label>
                    <input type="text" className="form-control" id="motif"/>
                </div>
                <div className="mb-3">
                    <label className="form-label">Reciever account's number</label>
                    <input type="number" className="form-control" id="receiver_id"/>
                </div>
         

            <button type="submit" className="btn btn-submit text-light">Submit</button>
        </form>        </>
    )
}
} 