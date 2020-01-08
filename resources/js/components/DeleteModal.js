import React from "react";

export const DeleteModal = ({onClose = () => {}, onDelete = () => {}}) => {
    return(
        <>
            <div className="black-overlay" onClick={onClose()}/>
            <div className="popup-dialog">
                <p>Ви впевнені?</p>
                <button className="btn btn-danger mr-2" onClick={onDelete()}>Видалити</button>
                <button className="btn btn-secondary" onClick={onClose()}>Скасувати</button>
            </div>
        </>
    );
};

