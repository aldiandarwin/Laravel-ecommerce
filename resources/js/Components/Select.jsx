export default function Select({ placeholder, options, ...props }) {
    return (
        <select
            className='w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500'
            {...props}>
            <option value=''>{placeholder ? placeholder : 'Select an option'}</option>
            {options.map((option, index) => (
                <option key={index} value={option.id}>
                    {option.name}
                </option>
            ))}
        </select>
    );
}
