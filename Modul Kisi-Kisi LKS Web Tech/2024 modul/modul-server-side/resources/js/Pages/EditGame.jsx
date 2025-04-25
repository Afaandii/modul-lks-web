import { useForm } from "@inertiajs/react";

export default function UserList({ game }) {
    let gameData = game[0];
    const { data, setData, put } = useForm({
        title: gameData.title,
        description: gameData.description,
        thumbnail: null,
        zipfile: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append("title", data.title);
        formData.append("description", data.description);

        if (data.thumbnail) {
            formData.append("thumbnail", data.thumbnail);
        }
        if (data.zipfile) {
            formData.append("zipfile", data.zipfile);
        }

        formData.append("_method", "PUT");

        put(route("update-game", gameData.slug), {
            data: formData,
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
    };

    return (
        <div className="min-h-screen bg-gray-100">
            <div className="flex justify-center align-items-center flex-col">
                <div className="flex justify-center align-items-center flex-col mt-10 mb-10">
                    <h1 className="text-gray-900 font-medium text-center text-4xl mb-5">
                        Manage Game - Game Portal
                    </h1>
                </div>
                <form onSubmit={handleSubmit} encType="multipart/form-data">
                    <div className="flex justify-center items-center flex-col max-w-md mx-auto gap-5 mt-10">
                        <div className="border rounded-lg p-4 shadow-sm w-full">
                            <label
                                htmlFor="title"
                                className="text-gray-500 text-sm font-medium mb-1 block"
                            >
                                title <span className="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                placeholder="title"
                                value={data.title}
                                onChange={(e) =>
                                    setData("title", e.target.value)
                                }
                                className="border rounded-md w-full p-2 text-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                            />
                        </div>
                        <div className="border rounded-lg p-4 shadow-sm w-full">
                            <label
                                htmlFor="description"
                                className="text-gray-500 text-sm font-medium mb-1 block"
                            >
                                Description{" "}
                                <span className="text-red-500">*</span>
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                placeholder="Description"
                                value={data.description}
                                onChange={(e) =>
                                    setData("description", e.target.value)
                                }
                                cols={50}
                                rows={5}
                                className="border rounded-md w-full p-2 text-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                            />
                        </div>
                        <div className="border rounded-lg p-4 shadow-sm w-full">
                            <label
                                htmlFor="thumbnail"
                                className="text-gray-500 text-sm font-medium mb-1 block"
                            >
                                Thumbnail{" "}
                                <span className="text-red-500">*</span>
                            </label>
                            <input
                                type="file"
                                className="file-input file-input-bordered file-input-success w-full max-w-xs"
                                name="thumbnail"
                                id="thumbnail"
                                onChange={(e) =>
                                    setData("thumbnail", e.target.files[0])
                                }
                            />
                        </div>

                        <div className="border rounded-lg p-4 shadow-sm w-full">
                            <label
                                htmlFor="game"
                                className="text-gray-500 text-sm font-medium mb-1 block"
                            >
                                File Game (ZIP){" "}
                                <span className="text-red-500">*</span>
                            </label>
                            <input
                                type="file"
                                className="file-input file-input-bordered file-input-primary w-full max-w-xs"
                                name="zipfile"
                                id="game"
                                onChange={(e) =>
                                    setData("zipfile", e.target.files[0])
                                }
                            />
                        </div>

                        <div className="flex justify-center align-items-center mt-10 gap-10">
                            <button
                                type="submit"
                                className="btn btn-primary w-full p-2"
                            >
                                Submit
                            </button>
                            <a
                                className="btn btn-error w-full p-3"
                                href={route("user-list")}
                            >
                                Back
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    );
}
