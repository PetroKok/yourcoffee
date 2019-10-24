import React from "react";

export const DeleteModal = ({onClose = () => {}, onDelete = () => {}}) => {
    return(
        <>
            <div className="black_overlay" onClick={onClose()}></div>
            <div className="popup">
                <div className="popup-content">
                    <p>Are you sure?</p>
                    <button className="btn btn-danger mr-2" onClick={onDelete()}>Delete</button>
                    <button className="btn btn-secondary" onClick={onClose()}>Cancel</button>
                </div>
            </div>
        </>
    );
}
